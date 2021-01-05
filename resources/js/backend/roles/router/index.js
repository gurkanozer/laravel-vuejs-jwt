import Master from "../../Master"
import List from "../components/List"
import Add from "../components/Add"
import Edit from "../components/Edit"

export default [
    {
        path:"/v1/user-roles",
        component: Master,
        meta: {
            requiresAuth: true
        },
        children:[
            {
                path:"/",
                component:List,
                name:"list-roles"
            },
            {
                path:"add",
                component:Add,
                name:"add-role"
            },
            {
                path:"edit/:id",
                component:Edit,
                name:"edit-role"
            }
        ]
    }
]