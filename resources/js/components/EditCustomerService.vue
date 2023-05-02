<style scoped>
form input, select {
    background: rgb(223, 223, 223);
    color: black;
    border-radius: 5px;
}
form input:focus {
    background: whitesmoke;
}
.form-group--error {
    animation-name: shakeError;
    animation-fill-mode: forwards;
    animation-duration: .6s;
    animation-timing-function: ease-in-out;
    margin-bottom: 45px;
    box-shadow: 0 0rem 1rem rgba(145, 42, 42, 0.733)!important;
}
@keyframes shakeError{
  0% {
      transform: translateX(0);
  }
  15% {
      transform: translateX(0.375rem);
  }
  30% {
      transform: translateX(-0.375rem);
  }
  45% {
      transform: translateX(0.375rem);
  }
  60% {
      transform: translateX(-0.375rem);
  }
  75% {
      transform: translateX(0.375rem);
  }
  90% {
      transform: translateX(-0.375rem);
  }
  100% {
      transform: translateX(0);
  }
}
</style>
<template>
    <main>
        <div class="row">
            <h3 class="text-center mb-3">{{pageTitle}}</h3>
            <div class="col-6 mx-auto bg-dark py-4 rounded">
                <div v-if="response"
                    class="alert alert-dismissible fade show" :class="response.status ? 'alert-success' : 'alert-danger'"
                    role="alert"
                    data-tor="show:rotateX.from(90deg) show:@--tor-translateZ(-5rem;0rem) show:pull.down(half) perspective-self(3000px) slow"
                >
                    <div class="center-v">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-exclamation-triangle-fill me-2"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
                            ></path>
                        </svg>
                        {{ response.message }}
                    </div>
                    <hr />
                    <p v-if="!response.status" class="mb-0 small opacity-70">
                        {{ response.message }}
                        <code class="d-block" v-for="error in response.errors">{{error[0]}}</code>
                        <button class="btn btn-primary" @click="retry()">Retry</button>
                    </p>
                    <p v-else class="mb-0 small opacity-70">
                        <a class="btn btn-primary" href="/admin/system/customer-service">Back to customers services list</a>
                    </p>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    ></button>
                </div>
                <form v-if="!submited" @submit.prevent="submit()">
                    <div class="form-floating mb-3" >
                        <input
                            type="email"
                            class="form-control"
                            v-model="item.email"
                            required
                            id=""
                        />
                        <label for="" class="text-black">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            v-model="item.phone"
                            required
                            id=""
                        />
                        <label for="" class="text-black">Phone Number</label>
                    </div>
                    <div class="row">
                        <button
                            class="btn btn-primary w-25 mx-auto"
                            type="submit"
                        >
                            Save
                        </button>
                    </div>
                </form>
                <div v-if="spinning" class="row">
                    <div class="spinner-border text-light mx-auto" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import { computed, ref, reactive } from "vue";
import { useAdminStore } from "@/stores/AdminStore";
export default {
    props: {
        id: {
            type: String,
            required: true,
        },
        pageTitle: {
            type: String,
            default: "Editing",
        },
    },
    setup() {
        const mystore = useAdminStore();

        return {
            mystore
        };
    },
    data() {
        return {
            item: computed(() => this.mystore.item),
            response: computed(() => this.mystore.res),
            submited: ref(false),
            spinning: ref(false),
        };
    },
    methods: {
        async submit() {
            this.submited=true
            this.spinning=true
            setTimeout(() => {
                this.spinning=false
            }, 500);
            await this.mystore.updateItem("/admin/update/customer-service/"+this.id, this.item);
        },
        retry(){
            window.location.reload()
        }
    },
    created: function () {
         this.mystore.getItem("/admin/get/item/customer-service/" + this.id);
    },
};
</script>
