import Master from "../../Master"
import List from "../components/List"

export default [
    {
        path:"/v1/user-roles/permissions/:id",
        component: Master,
        meta: {
            requiresAuth: true
        },
        children:[
            {
                path:"/",
                component: List,
                name:"permissions",
        }
        ]
    }
]