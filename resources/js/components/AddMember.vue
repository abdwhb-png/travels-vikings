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
            <h5 v-if="dealCount<40" class="text-danger">Please add at least 40 deals</h5>
            <div v-else class="col-6 mx-auto bg-dark py-4 rounded">
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
                        <code class="d-block" v-for="(error,index) in response.errors" v-bind:key="index">{{error[0]}}</code>
                        <button class="btn btn-primary" @click="retry()">Retry</button>
                    </p>
                    <p v-else class="mb-0 small opacity-70">
                        <a class="btn btn-primary" href="/admin/members/list">Back to members list</a>
                    </p>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    ></button>
                </div>
                <form v-if="!submited" @submit.prevent="submit()">
                    <div class="form-floating mb-3" :class="v$.username.$errors.length ? 'form-group--error mb-4' : ''">
                        <input
                            type="text"
                            class="form-control"
                            v-model="form.username"
                            required
                            id=""
                        />
                        <label for="" class="text-black">Username</label>
                        <code class="text-danger px-2" v-for="error of v$.username.$errors" :key="error.$uid"> {{ error.$message }} </code>
                    </div>
                    <div class="form-floating mb-3" :class="v$.email.$errors.length ? 'form-group--error mb-4' : ''">
                        <input
                            type="email"
                            class="form-control"
                            v-model="form.email"
                            required
                            id=""
                        />
                        <label for="" class="text-black">Email Adrress</label>
                        <code class="text-danger px-2" v-for="error of v$.email.$errors" :key="error.$uid"> {{ error.$message }} </code>
                    </div>
                    <div class="form-floating mb-3" :class="v$.password.$errors.length ? 'form-group--error mb-4' : ''">
                        <input
                            type="text"
                            class="form-control"
                            v-model="form.password"
                            required
                            id=""
                        />
                        <label for="" class="text-black">Password</label>
                        <code class="text-danger px-2" v-for="error of v$.password.$errors" :key="error.$uid"> {{ error.$message }} </code>
                    </div>
                    <div class="form-floating mb-3" :class="v$.confirm.$errors.length ? 'form-group--error mb-4' : ''">
                        <input
                            type="text"
                            class="form-control"
                            v-model="form.confirm"
                            required
                            id=""
                        />
                        <label for="" class="text-black">Confirm Password</label>
                        <code class="text-danger px-2" v-for="error of v$.confirm.$errors" :key="error.$uid"> {{ error.$message }} </code>
                    </div>
                    <div class="form-floating mb-3" :class="v$.phone.$errors.length ? 'form-group--error mb-4' : ''">
                        <input
                            type="tel"
                            class="form-control"
                            required
                            id=""
                            v-model="form.phone"
                        />
                        <label for="" class="text-black">Phone Number</label>
                        <code class="text-danger px-2" v-for="error of v$.phone.$errors" :key="error.$uid"> {{ error.$message }} </code>
                    </div>
                    <div class="form-floating mb-3" :class="v$.balance.$errors.length ? 'form-group--error mb-4' : ''">
                        <input
                            type="number"
                            class="form-control"
                            id=""
                            v-model="form.balance"
                        />
                        <label for="" class="text-black"
                            >Balance</label>
                            <code class="text-danger px-2" v-for="error of v$.balance.$errors" :key="error.$uid"> {{ error.$message }} </code>
                    </div>
                    <div class="form-floating mb-3" :class="v$.task_cost.$errors.length ? 'form-group--error mb-4' : ''">
                        <input
                            type="number"
                            class="form-control"
                            id=""
                            v-model="form.task_cost"
                        />
                        <label for="" class="text-black"
                            >Default Task Cost</label>
                            <code class="text-danger px-2" v-for="error of v$.task_cost.$errors" :key="error.$uid"> {{ error.$message }} </code>
                    </div>
                    <div class="form-floating mb-3" :class="v$.parent_id.$errors.length ? 'form-group--error mb-4' : ''">
                        <select v-model="form.parent_id" id="" class="form-select">
                            <option value="" disabled selected>Select invitation code</option>
                            <option v-for="(item, index) in refferals" v-bind:key="index" :value="item.member_id">{{item.invit_code}}</option>
                        </select>
                        <label for="" class="text-black">Invitation Code</label>
                        <code class="text-danger px-2" v-for="error of v$.parent_id.$errors" :key="error.$uid"> {{ error.$message }} </code>
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
import useValidate from '@vuelidate/core'
import { required, email, minLength, sameAs, alpha, numeric, integer } from '@vuelidate/validators'
export default {
    props: {
        pageTitle: {
            type: String,
            default: "Create",
        },
        dealCount:{
            type: String
        },
    },
    setup() {
        const mystore = useAdminStore();
         const form = reactive({
            username: '',
            email: '',
            password: '',
            confirm: '',
            phone: '',
            balance: 0,
            task_cost: 10,
            parent_id: '',
        })
        const rules = computed(() => ({
            username: { required, alpha, minLength: minLength(5) },
            email: { required, email },
            password: { required, minLength: minLength(8) },
            confirm: { required, sameAs: sameAs(form.password) },
            phone: { required },
            balance: { required, numeric },
            task_cost: { required, numeric },
            parent_id: { required, integer },
        }))

        const v$ = useValidate(rules, form)

        return {
            mystore, form, v$
        };
    },
    data() {
        return {
            refferals: computed(() => this.mystore.list),
            response: computed(() => this.mystore.res),
            submited: ref(false),
            spinning: ref(false),
        };
    },
    methods: {
        async submit() {
            const result = await this.v$.$validate()
            if (!result) return
            await this.mystore.storeItem("/admin/store/member/", this.form)
            this.submited=true
            this.spinning=true
            setTimeout(() => {
            this.spinning=false
            }, 600);
        },
        retry(){
            window.location.reload()
        }
    },
    created: function () {
        this.mystore.getList("/admin/get/list/refferals/")
    },
};
</script>
