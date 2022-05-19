<template>
  <h2>Register</h2>
  <form @submit.prevent="submitForm">
    <label for="">Name</label>
    <br>
    <input type="text" name="name" autofocus v-model="nameRef" >
    <br>
    <label for="">Phone</label>
    <br>
    <input type="text" name="phone" autofocus v-model="phoneRef" >
    <br>
    <label for="">Email</label>
    <br>
    <input type="text" name="email" autofocus v-model="emailRef" >
    <br>
    <label for="">Password</label>
    <br>
    <input type="password" name="password" v-model="passwordRef" >
    <br>
    <label for="">Password Confirm</label>
    <br>
    <input type="password" name="password" v-model="passwordConfirmRef" >
    <br>
    <button type="submit">submit</button>
  </form>  
</template>

<script>
import { ref } from 'vue'
export default {
    setup() {
        const nameRef = ref('')
        const phoneRef = ref('')
        const emailRef = ref('')
        const passwordRef = ref('')
        const passwordConfirmRef = ref('')

        const submitForm = async () => {
            register()
        }

        const register = async () => {
            await axios({
                method: 'POST',
                url: '/api/register',
                data: {
                    name: nameRef.value,
                    phone: phoneRef.value,
                    email: emailRef.value,
                    password: passwordRef.value,
                    password_confirmation: passwordConfirmRef.value,
                }
            }).then(response => {
                console.log(response)
            })
        }
        
        return { nameRef, phoneRef, emailRef, passwordRef, passwordConfirmRef, submitForm }
    },
}
</script>

<style>

</style>