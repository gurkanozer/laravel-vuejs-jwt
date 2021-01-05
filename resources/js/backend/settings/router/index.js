import Master from "../../Master"
import Settings from "../components/Settings"
import Edit from "../components/Edit"
export default [
    {
        path:"/v1/settings",
        component: Master,
        meta: {
            requiresAuth: true
        },
        children:[
            {
                path:"/",
                component:Settings,
                name:"settings"
            },
            {
                path:"edit",
                component:Edit,
                name:"edit-settings"
            }
        ]
    }
]