<template>
    <main>
        <div class="row">
            <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title mb-1">Transactions History</h4>
                    <p class="text-muted mb-1">Data status</p>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="preview-list" v-if="transactions">
                        <div v-for="(item, index) in transactions" v-bind:key="index" class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                                <div v-if="item.type==0" class="preview-icon bg-danger">
                                     <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                </div>
                                <div v-else class="preview-icon bg-success">
                                    <i class="fa-solid fa-arrow-up-from-bracket fa-flip-vertical"></i>
                                </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                                <div class="flex-grow">
                                <h6 class="preview-subject">{{item.type==1 ? "Credit" : "Debit"}}</h6>
                                <p class="text-muted mb-0">{{item.title}}</p>
                                </div>
                                <div class="me-auto text-sm-right pt-2 pt-sm-0">
                                <p class="text-muted">{{item.created_at.replace('.000000Z', ' ').replace('T', ' ')}}</p>
                                <p class="mb-0" :class="item.type == 1 ? 'text-success' : 'text-danger'">{{item.type == 1 ? "+" : "-"}}  {{item.amount}} $</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="preview-list">
                        <p class="text-muted">No transactions yet.</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </main>
</template>
<script>
import { ref } from 'vue'
export default {
    props:{
        transactions:{
            type: Object,
            required: true,
        },
    },
      setup() {
        
        return {
          
        }
      },
      data() {
        return {
          
        }
      },
      methods:{
      },
      created: function () {
      }
}
</script>