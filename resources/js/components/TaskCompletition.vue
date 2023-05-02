<template>
    <main>
      <div class="row my-4">
        <div class="progress px-0 progress-md portfolio-progress">
            <div id="myBar" class="progress-bar bg-success" role="progressbar" :style="'width: '+width+'%'" aria-valuenow="0" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
        <button type="button" @click="submit" class="btn btn-primary my-2 btn-lg bg-gradient w-25 mx-auto" :disabled="width<100?true:false" >
            <div v-if="width<100" class="spinner-border text-secondary" role="status">
            </div>
            <span v-else>Submit</span>
        </button>
      </div>
    </main>
</template>

<script>
import {ref} from "vue"
    export default {
        props:{
          taskId:{
            type: String,
            required: true
          }
        },
        data() {
        return {
          i : ref(0),
          width : ref(1)
        }
      },
      methods: {
        move() {
            var id = setInterval(() => {
              if (this.width >= 100) {
                clearInterval(id);
              } else {
                this.width++;
              }
            }, 20);
        },
        submit(){
           axios
                .post("/member/submit/task/" + this.taskId)
                .then((response) => {
                    console.log("Completing task..");
                    if(response.data.frozen) window.location.replace('/member/dashboard')
                    if(!response.data.status) alert('Ooops!! Something wrong. Please contact the customer service')
                    window.location.replace('/member/journey')
                })
                .catch((error) => console.log(error));
        }
      },
     created: function () {
        this.move()      
      }
    }
</script>
