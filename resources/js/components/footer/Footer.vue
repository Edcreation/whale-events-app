<template>
  <footer class="relative bg-blueGray-800 text-white pt-8 pb-6 ">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap text-center lg:text-left">
        <div class="w-full lg:w-6/12 px-4">
          <h4 class="text-3xl font-semibold">Let's keep in touch!</h4>
          <h5 class="text-lg mt-0 mb-2 text-blueGray-300">
            Find us on any of these platforms, we respond 1-2 business days.
          </h5>
          <div class="mt-6 lg:mb-0 mb-6">
            <button
              class="border border-gray-700 text-lightBlue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
              type="button"
            >
              <i class="fab fa-twitter"></i>
            </button>
            <button
              class="border border-gray-700 text-lightBlue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
              type="button"
            >
              <i class="fab fa-facebook-square"></i>
            </button>
            <button
              class="border border-gray-700 text-pink-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
              type="button"
            >
              <i class="fab fa-dribbble"></i>
            </button>
            <button
              class="border border-gray-700 text-blueGray-200 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
              type="button"
            >
              <i class="fab fa-github"></i>
            </button>
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-4">
          <div class="flex flex-wrap items-top mb-6">
            <div class="w-full lg:w-4/12 px-4 ml-auto">
              <span
                class="block uppercase text-blueGray-300 text-sm font-semibold mb-2"
              >
                Useful Links
              </span>
              <ul class="list-unstyled">
                <li>
                  <a
                    class="text-blueGray-400 hover:text-blueGray-500 font-semibold block pb-2 text-sm"
                    href="https://www.creative-tim.com/presentation?ref=vn-footer"
                  >
                    Home
                  </a>
                </li>
                <li>
                  <a
                    class="text-blueGray-400 hover:text-blueGray-500 font-semibold block pb-2 text-sm"
                    href="https://blog.creative-tim.com?ref=vn-footer"
                  >
                    Events
                  </a>
                </li>
              </ul>
            </div>
            <div class="w-full lg:w-4/12 px-4">
              <span
                class="block uppercase text-blueGray-300 text-sm font-semibold mb-2"
              >
                Other Resources
              </span>
              <ul class="list-unstyled">
                <li>
                  <a
                    class="text-blueGray-400 hover:text-blueGray-500 font-semibold block pb-2 text-sm"
                    href="https://github.com/creativetimofficial/vue-notus/blob/main/LICENSE.md?ref=vn-footer"
                  >
                    MIT License
                  </a>
                </li>
                <li>
                  <a
                    class="text-blueGray-400 hover:text-blueGray-500 font-semibold block pb-2 text-sm"
                    href="https://creative-tim.com/terms?ref=vn-footer"
                  >
                    Terms & Conditions
                  </a>
                </li>
                <li>
                  <a
                    class="text-blueGray-400 hover:text-blueGray-500 font-semibold block pb-2 text-sm"
                    href="https://creative-tim.com/privacy?ref=vn-footer"
                  >
                    Privacy Policy
                  </a>
                </li>
                <li>
                  <a
                    class="text-blueGray-400 hover:text-blueGray-500 font-semibold block pb-2 text-sm"
                    href="https://creative-tim.com/contact-us?ref=vn-footer"
                  >
                    Contact Us
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-6 border-blueGray-300" />
      <div
        class="flex flex-wrap items-center md:justify-between justify-center"
      >
        <div class="w-full md:w-4/12 px-4 mx-auto text-center">
          <div class="text-sm text-blueGray-500 font-semibold py-1">
            Copyright © {{ date }} Mugisha.J.Eddy
            .
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'base',
  data() {
    return {
      date: new Date().getFullYear(),
    };
  },
};
</script>
