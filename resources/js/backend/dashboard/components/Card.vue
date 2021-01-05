<template>
    <div class="card m-2" style="max-width: 240px">
    <div class="card-body">
        <h4 class="card-title text-center text-primary">
            {{title}}
        </h4>
        <hr />
        <div class="text-center">
            <h4>{{count}}</h4>
        </div>
    </div>
    </div>
</template>
<script>
export default {
    props:["title","count"]
}
</script>