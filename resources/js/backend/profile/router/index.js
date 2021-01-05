import Master from "../../Master";
import Profile from "../components/Profile";
import Password from "../components/Password";
import Edit from "../components/Edit";

export default [
    {
        path: "/v1/profile",
        component: Master,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                component: Profile,
                path: "/",
                name: "profile"
            },
            {
                component: Edit,
                path:"edit",
                name:"edit-profile"
            },
            {
                component: Password,
                path:"password",
                name:"change-password"
            }
        ]
    }
];
