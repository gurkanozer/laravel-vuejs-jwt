import Master from "../../Master"
import EditStaticPages from "../components/EditStaticPages"
export default [
    {
        path:"/v1/static-pages",
        component: Master,
        meta: {
            requiresAuth: true
        },
        children:[
            {
                path:"edit/:id",
                component:EditStaticPages,
                name:"edit-static-pages"
            }
        ]
    }
]