<style scoped>
   .toggle {
      --width: 80px;
      --height: calc(var(--width) / 3);

      position: relative;
      display: inline-block;
      width: var(--width);
      height: var(--height);
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
      border-radius: var(--height);
      cursor: pointer;
    }

    .toggle input {
      display: none;
    }

    .toggle .slider {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border-radius: var(--height);
      background-color: #ccc;
      transition: all 0.4s ease-in-out;
    }

    .toggle .slider::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: calc(var(--height));
      height: calc(var(--height));
      border-radius: calc(var(--height) / 2);
      background-color: #fff;
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
      transition: all 0.4s ease-in-out;
    }

    .toggle input:checked+.slider {
      background-color: #2196F3;
    }

    .toggle input:checked+.slider::before {
      transform: translateX(calc(var(--width) - var(--height)));
    }

    .toggle .labels {
      position: absolute;
      top: 8px;
      left: 0;
      width: 100%;
      height: 100%;
      font-size: 12px;
      font-family: sans-serif;
      transition: all 0.4s ease-in-out;
    }

    .toggle .labels::after {
      content: attr(data-off);
      position: absolute;
      right: 5px;
      color: #4d4d4d;
      opacity: 1;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
      transition: all 0.4s ease-in-out;
    }

    .toggle .labels::before {
      content: attr(data-on);
      position: absolute;
      left: 5px;
      color: #ffffff;
      opacity: 0;
      text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.4);
      transition: all 0.4s ease-in-out;
    }

    .toggle input:checked~.labels::after {
      opacity: 0;
    }

    .toggle input:checked~.labels::before {
      opacity: 1;
    }
</style>
<template>
    <main id="customer-service">
        <div class="row ">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                 <h4 class="card-title">System Customer Service</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th> # </th>
                        <th> Status </th>
                        <th> Email </th>
                        <th> Phone </th>
                        <th> Created At </th>
                        <th> Actions </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in list" v-bind:key="index">
                        <td>{{item.id}}</td>
                        <td><label v-if="!item['status']" class="toggle mx-4">
                          <input type="checkbox" v-bind:checked="item['status']" @click="changeStatus(item['id'], item['status'])"><span class="slider"></span><span class="labels" data-on="ON" data-off="OFF"></span>
                        </label><i v-else class="mdi mdi-check-circle-outline fs-3 text-primary"></i></td>
                        <td>{{item.email}}</td>
                        <td> {{item.phone}} </td>
                        <td> {{item.created_at}} </td>
                        <td> <crud-buttons-component :urls="mystore.customerServiceCrudUrls(item['id'])"></crud-buttons-component> </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </main>
</template>

<script>
import { computed } from 'vue'
import { useAdminStore } from "@/stores/AdminStore"
    export default {
      setup() {
        const mystore = useAdminStore()
        return {
          mystore
        }
      },
      data() {
        return {
          list:computed(() => this.mystore.list),
        }
      },
      methods: {
        changeStatus(id, status){
          axios
            .put("/admin/change/customer-service/status/" + id, {status: status})
            .then((response) => {
                if(response.data.status) this.mystore.getList('/admin/get/list/customer-services')
                else alert('Oops.. Something wrong. Please retry')
            })
            .catch((error) => console.log(error));
        }
      },
     created: function () {
        this.mystore.getList('/admin/get/list/customer-services')
      }
    }
</script>
