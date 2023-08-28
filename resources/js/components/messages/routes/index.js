import { SubscribersIndex,show } from '../components/index'

export default [
        {
            path: '/subscribers',
            component: SubscribersIndex,
            name: 'subscribers',
            meta: {
              guest: false,
              needsAuth: true,
              needsSubscrition: true,
            }
        },
        {
          path: '/subscriber/:id',
          component: show,
          name: 'show',
          meta: {
            guest: false,
            needsAuth: true,
            hasSubscribed: true,
          }
      },
         

]