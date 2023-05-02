<template>
    <main>
      <div class="row">
          <div class="col-12 grid-margin stretch-card my-">
            <div class="card corona-gradient-card">
              <div class="card-body py-0 px-0 px-sm-3">
                <div class="row align-items-center py-2">
                  <div class="col-4 col-sm-3 col-xl-2">
                    <img src="/assets/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid" alt="">
                  </div>
                  <div class="col-5 col-sm-7 col-xl-8 p-0">
                    <h4 class="mb-1 mb-sm-0">{{ head }}</h4>
                    <p class="mb-0 mt-3 font-weight-normal d-none d-sm-block">{{ subhead }}</p>
                  </div>
                  <div v-if="btn" class="col-3 col-sm-2 col-xl-2 ps-0 text-center">
                    <span>
                      <a :href="btnLink" class="btn btn-primary btn-rounded get-started-btn">{{ btnText }}</a>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </main>
</template>

<script>
    export default {
        props:{
          head:{
            type: String,
            required: true
          },
          subhead:{
            type: String,
            required: true
          },
          btn:{
            type: Boolean,
            default: false
          },
          btnText:{
            type: String,
          }, 
          btnLink:{
            type: String,
          }
        }
    }
</script>
