<template>
    <li class="flex items-center">
        <button @click="openModal"
            class="bg-emerald-500 text-white active:bg-emerald-600 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
            type="button">
            <i class="fas fa-arrow-alt-circle-down"></i> Login / Register
        </button>
    </li>

    <div v-if="modalOpen"
        class="bg-black/70 flex flex-row items-start pt-20 justify-center w-full h-full left-0 top-0 absolute overscroll-none z-40">
        <div class="max-w-[600px] w-full min-h-36 m-4 relative">
            <div @click="closeModal" class="absolute text-white/75 cursor-pointer text-3xl right-14 -top-10">
                <i class="fa-regular fa-circle-xmark"></i>
            </div>
            <div class="max-w-lg w-full">
                <div style="box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);"
                    class="bg-gray-800 rounded-lg shadow-xl overflow-hidden">
                    <div class="p-4 md:p-8">
                        <h2 class="text-center text-3xl font-extrabold text-white">
                            Welcome Back
                        </h2>
                        <p class="mt-4 text-center text-gray-400">Sign in to continue</p>
                        <form @submit.prevent="handleLogin" class="mt-8 space-y-6 flex flex-col items-center">
                            <div class="rounded-md shadow-sm w-full">
                                <div class="flex items-center justify-center">
                                    <div class="rounded-lg w-full flex flex-col gap-4">
                                        <div class="flex w-full ">
                                            <div class="flex w-10 items-center justify-center text-white">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                            <input v-model="credintials.email" @input="setLemail" type="email"
                                                class="w-full bg-blueGray-800 border-0 border-b rounded-md border-gray-600 focus:border-green-500 active:border-none focus:ring-0 active:ring-0 placeholder:text-white/65 text-white pl-2 text-base font-semibold outline-0"
                                                placeholder="Email" id="email">

                                        </div>
                                        <p v-if="emailError" class="w-11/12 text-red-600 capitalize italic text-sm">
                                        <div v-for="item in emailError" :key="item.id">
                                            {{ item }}
                                        </div>
                                        </p>

                                        <div class="flex w-full">
                                            <div class="flex w-10 items-center justify-center text-white">
                                                <i class="fa-solid fa-lock"></i>
                                            </div>
                                            <input v-model="credintials.password" @input="setLpassword" type="password"
                                                class="w-full bg-blueGray-800 border-0 border-b rounded-md border-gray-600 active:border-none focus:ring-0 active:ring-0 placeholder:text-white/65 text-white pl-2 text-base font-semibold outline-0"
                                                placeholder="Password" id="pass">

                                        </div>
                                        <p v-if="passwordError" class="w-11/12 text-red-600 capitalize italic text-sm">
                                        <div v-for="item in passwordError" :key="item.id">
                                            {{ item }}
                                        </div>
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <div class="flex items-center justify-between flex-wrap mt-4 w-[96%]">
                                <div class="flex items-center">
                                    <input
                                        class="h-4 w-4 text-indigo-500 focus:ring-indigo-400 mr-1 border-gray-600 rounded"
                                        type="checkbox" name="remember-me" id="remember-me" />
                                    <label class="ml-2 block text-sm text-gray-400" for="remember-me"> Remember
                                        me</label>
                                </div>

                                <div class="text-sm">
                                    <a class="font-medium text-white underline hover:text-indigo-400" href="#">
                                        Forgot your password?
                                    </a>
                                </div>
                            </div>

                            <div class="flex justify-center w-full">
                                <button
                                    class="cursor-pointer bg-blue-600 text-white  hover:bg-blue-700 hover:shadow-lg transition-all group"
                                    :class="{ 'w-11 h-11 rounded-full active:duration-300 ease-in-out': loading, 'w-full h-12 rounded-lg': !loading }">
                                    <svg v-if="loading" class="animate-spin group-active:block mx-auto" width="33"
                                        height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.1792 0.129353C10.6088 0.646711 8.22715 1.74444 6.16886 3.36616C4.13416 4.96799 2.42959 7.14686 1.38865 9.48493C0.202866 12.1414 -0.241805 15.156 0.125386 18.0413C0.684593 22.4156 3.02922 26.3721 6.63375 29.0186C8.01155 30.0301 9.65549 30.8757 11.2725 31.3997C12.0405 31.6518 13.4857 32 13.7518 32H13.8361V30.7232V29.4464L13.762 29.4331C11.8485 29.0252 10.2787 28.3818 8.7493 27.3802C7.50961 26.5644 6.29688 25.4402 5.40416 24.2794C3.88824 22.3095 2.98206 20.0908 2.66203 17.5736C2.57781 16.8905 2.57781 15.1029 2.66203 14.4396C2.88773 12.7317 3.31556 11.3288 4.06678 9.863C5.88589 6.3045 9.23103 3.67791 13.1286 2.746C13.4352 2.67303 13.7182 2.60671 13.762 2.59676L13.8361 2.58349V1.29009C13.8361 0.577066 13.8327 -0.00330353 13.8293 1.33514e-05C13.8226 1.33514e-05 13.5329 0.0597076 13.1792 0.129353Z"
                                            fill="white"></path>
                                        <path
                                            d="M19.563 1.38627V2.67967L19.7078 2.71615C20.8768 3.01463 21.7527 3.32968 22.6723 3.78071C24.8249 4.84528 26.6878 6.467 28.042 8.47011C29.248 10.251 29.9858 12.2375 30.2654 14.4562C30.3126 14.831 30.326 15.1792 30.326 16.0149C30.326 17.169 30.2923 17.5869 30.1205 18.5022C29.7365 20.575 28.8404 22.5681 27.5266 24.2761C26.8158 25.2014 25.8019 26.2029 24.862 26.9027C23.3056 28.0634 21.7324 28.7997 19.7078 29.3137L19.563 29.3502V30.6436V31.9403L19.691 31.9204C20.0616 31.8541 21.1362 31.5689 21.6516 31.4031C24.8216 30.365 27.6041 28.3951 29.6152 25.7652C30.2789 24.8996 30.7337 24.1667 31.2356 23.1618C31.8959 21.8419 32.3102 20.6479 32.5999 19.2318C33.4354 15.1394 32.6606 10.9441 30.417 7.40886C28.4126 4.24833 25.3067 1.8373 21.692 0.640079C21.1867 0.470943 20.038 0.169149 19.7078 0.112772L19.563 0.0895557V1.38627Z"
                                            fill="white"></path>
                                    </svg>
                                    <span v-if="!loading" class="">Sign In</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="px-8 py-4 bg-gray-700 text-center">
                        <span class="text-gray-400">Don't have an account? </span>
                        <a class="font-medium text-white underline hover:text-indigo-400" href="#">Sign up</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import { toast } from 'vue3-toastify';
import { mapActions } from 'vuex';

export default {
    name: 'AuthModal',
    data() {
        return {
            modalOpen: false,
            loading: false,
            credintials: {
                email: '',
                password: ''
            },
            emailError: null,
            passwordError: null
        }
    },
    methods: {
        ...mapActions('auth', ['login']),
        async handleLogin() {
            try {
                console.log('m');
                this.loading = true; // Set loading state to true
                this.emailError = null;
                this.passwordError = null;

                await this.login({ email: this.credintials.email, password: this.credintials.password });// Dispatch login action with response data

            } catch (error) {
                this.handleError(error); // Call error handling function
            } finally {
                this.loading = false;
            }
        },
        handleError(error) {
            toast.error(error.response.data.message, {
                position: toast.POSITION.TOP_CENTER,
                
            });
            const errors = error.response.data.errors;
            if (errors.email) {
                this.emailError = errors.email;
            }
            if (errors.password) {
                this.passwordError = errors.password;
            }
        },
        openModal() {
            this.modalOpen = true;
        },
        closeModal() {
            this.modalOpen = false;
        },
        setLemail() {

        },
    },
}
</script>