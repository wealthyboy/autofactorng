<template>
    <paystack
        :amount="amount"
        :email="email"
        :paystackkey="paystackkey"
        :reference="reference"
        :callback="callback"
        :close="close"
        :embed="false"
    >
       <i class="fas fa-money-bill-alt"></i>
       Make Payment
    </paystack>
</template>

<script>
import paystack from 'vue-paystack';
export default {
    components: {
        paystack
    },
    data(){
        return{
          paystackkey: "pk_test_844112398c9a22ef5ca147e85860de0b55a14e7c", //paystack public key
          email: "foobar@example.com", // Customer email
          amount: 1000000 // in kobo  tejumade1991ADE*
        }
    },
    computed: {
      reference(){
        let text = "";
        let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for( let i=0; i < 10; i++ )
          text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
      }
    },
    methods: {
      callback: function(response){
        console.log(response)
      },
      close: function(){
          console.log("Payment closed")
      }
    }
}
</script>



