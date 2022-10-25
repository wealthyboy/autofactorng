import axios from "axios";
import router from "../../../router";
import store from '../../../vuex'
 


export const flashMessage = ({ commit },message) => {
    commit('setMessage', message) 
    setTimeout(() => {
        commit('clearMessage')  
    }, 90000);
}

