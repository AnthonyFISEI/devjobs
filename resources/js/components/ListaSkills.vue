<template>
    <div>
        <ul class="flex flex-wrap justify-center">
            <li
                class="border border-gray-500 px-10 py-3 mb-3 rounded mr-4"
                :class="verificarClaseActiva(skill)"
                v-for="( skill,i) in this.skills"
                v-bind:key="i"
                v-on:click="activar($event)"
            >{{skill}}</li>
        </ul>

        <input type="hidden" name="skills" id="skills">
    </div>
</template>



<script>

    export default{
        props: ['skills', 'oldskills'],
        
        created: function(){
            console.log(1);
            if(this.oldskills){
                const skillsArray = this.oldskills.split(',');
                console.log(skillsArray);

                skillsArray.forEach(skill =>  this.habilidades.add(skill));
            }
        },
        mounted: function(){
            // console.log(this.oldskills);
            document.querySelector('#skills').value = this.oldskills;
        },
        data:function(){

            return {
                //Set es como un arreglo pero no permite regiostros repetidos
                habilidades: new Set()
            }

        },methods:{
            activar(e){
                // console.log('diste click',e.target.textContent);

                if(e.target.classList.contains('bg-teal-400')){
                    //El skill esta en activo
                    e.target.classList.remove('bg-teal-400');

                    // Eliminar del Set de Hablildades
                    this.habilidades.delete(e.target.textContent);

                }else{
                    //no esta activo debo añadir
                    e.target.classList.add('bg-teal-400');
                    //Agregar al set de habilidades
                    this.habilidades.add(e.target.textContent);
                }
                //Agregar las habilidades al input hidden

                const stringHabilidades = [... this.habilidades];
                document.querySelector('#skills').value = stringHabilidades;
            },
            verificarClaseActiva(skill){
                // console.log(skill);

                return this.habilidades.has(skill) ? 'bg-teal-400' : '';
            }

        }
    }
</script>