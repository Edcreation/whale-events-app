<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $category_id = $request->query('categoryId');
        $page_size = intval($request->query('pageSize'));
        $search_query = $request->query('search');
    
        $eventsQuery = Event::query();
    
        if ($category_id) {
            $eventsQuery->whereHas('categories', function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            });

            $eventsQuery->orderBy('start_date', 'asc');
    
            // Return paginated results based on the category without considering the search query
            $events = $eventsQuery->with('categories')->paginate($page_size);
        } else {
            // Apply search condition if search query is provided
            if ($search_query) {
                $eventsQuery->where(function ($query) use ($search_query) {
                    $query->where('name', 'like', '%' . $search_query . '%')
                        ->orWhere('description', 'like', '%' . $search_query . '%');
                });
            }

            $eventsQuery->orderBy('start_date', 'desc');
    
            // Return paginated results based on the search query
            $events = $eventsQuery->with('categories')->paginate($page_size);
        }
    
        return response()->json($events);
    }

    public function show($id)
    {

        // Retrieve the event based on the ID
        $event = Event::with('tickets')->find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        return response()->json($event);
    }

    public function showBySlug($slug)
    {

        // Retrieve the event based on the ID
        $event = Event::where('slug', $slug)->with('tickets')->first();

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        return response()->json($event);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|string',
            'organiser' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date|after:now', // Ensure future date
            'end_date' => 'required|date|after:start_date', // Ensure after start date
            // Add validations for other fields
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $event = Event::create($request->all()); // Create a new event
        return response()->json($event, 201);
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'image' => 'string',
            'organiser' => 'string|max:255',
            'description' => 'string',
            'start_date' => 'date|after:now',
            'end_date' => 'date|after:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $updateData = $request->only([
            'name',
            'image',
            'organiser',
            'description',
            'start_date',
            'end_date',
            // Add other fields here if needed
        ]);

        // Update the event attributes
        $event->fill($updateData);

        // Update the slug if the name has been changed
        if ($request->has('name')) {
            $event->slug = Str::slug($request->name);
        }

        // Save the changes to the database
        $event->save();

        return response()->json($event, 200);
    }

    public function destroy($id)
    {
        // Retrieve the event based on the ID
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted successfully'], 200);
    }

    public function assignCategory($event_id, $category_id)
    {

        $event = Event::find($event_id);
        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $category = Category::find($category_id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $category->events()->attach($event);

        return response()->json([
            'message' => 'Category Assigned',
            'event' => $event,
            'categories' => $event->categories,
        ], 201);
    }
}
