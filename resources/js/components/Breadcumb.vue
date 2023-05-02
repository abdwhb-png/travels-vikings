<template>
    <div class="page-header">
        <h3 class="page-title"> {{ pageTitle }} </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="#">{{ parentPage }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ pageTitle}}</li>
        </ol>
        </nav>
    </div>
</template>

<script>
    export default {
        props:{
            pageTitle:{
                type: String,
                required: true
            },
            parentPage:{
                type: String,
                required: true
            }
        }
    }
</script>
