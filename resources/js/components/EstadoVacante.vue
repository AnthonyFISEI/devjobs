<template>
    <span
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
        :class="claseEstadoVacante()"
        @click="cambiarEstado"
        :key="estadoVacanteData"
    >
            {{ estadoVacante}}
    </span>

</template>


<script>
export default{
    props:['estado','vacanteId'],
    mounted(){
        // console.log(Number(this.vacanteId));
        this.estadoVacanteData=Number(this.estado)
    },
    data: function(){
        return{
            estadoVacanteData:null
        }
    },
    methods: {

        claseEstadoVacante(){
            return this.estadoVacanteData===1 ? "bg-green-100 text-green-800" : "bg-red-100 text-red-800"
        },
        cambiarEstado(){
            // console.log('click');
            if(this.estadoVacanteData===1){
                this.estadoVacanteData=0;
            }else{
                this.estadoVacanteData=1;
            }

            // enviar peticion a axios
            const params={
                estado: this.estadoVacanteData,

            }
            axios
                .post('/vacantes/' + this.vacanteId, params)
                .then(respuesta=> console.log(respuesta))
                .catch(error=>console.log(error))
        }


    },
    computed:{
        estadoVacante(){
            return this.estadoVacanteData===1 ? 'Activa' : 'Inactiva';
        }
    }

}

</script>
