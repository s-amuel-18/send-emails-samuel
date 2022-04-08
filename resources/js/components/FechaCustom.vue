<template>
    <span> {{formatearFecha}} </span>
</template>

<script>
export default {
    props: ["fecha", "formato"],
    mounted() {
        console.log(this.fecha);
    },
    computed: {
        formatearFecha() {
            return moment().locale("es").format(this.formato ? this.formato : "DD [de] MMMM [del] YYYY");
        }
    }

}
</script>
