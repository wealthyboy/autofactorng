import { isEmpty } from 'lodash'
import localforage from 'localforage'

export const setMessageType = (state,status) => {
   state.message.status = status
}

export const setMessage = (state,msg) => {
   state.message.message = msg
}

export const clearMessage = (state , msg) =>{
   state.message.message =null;
}

export const setNotification = (state,msg) => {
   if (isEmpty(msg)) {
      localforage.removeItem('notification',msg)
      return
   } 
  localforage.setItem('notification',msg)
}

