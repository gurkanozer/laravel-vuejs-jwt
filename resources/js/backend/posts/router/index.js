import Master from "../../Master"
import List from "../components/List"
import Add from "../components/Add"
import Edit from "../components/Edit"


export default [
    {
        path:"/v1/posts",
        component: Master,
        meta: {
            requiresAuth: true
        },
        children:[
            {
                path:"/",
                component:List,
                name:"list-posts"
            },
            {
                path:"add",
                component:Add,
                name:"add-post"
            },
            {
                path:"edit/:id",
                component:Edit,
                name:"edit-post"
            }
        ]
    }
]