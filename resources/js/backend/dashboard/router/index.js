import Master from "../../Master";
import Dashboard from "../components/Dashboard";
export default [
    {
        path: "/v1/dashboard",
        component: Master,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: "/",
                name: "dashboard",
                component: Dashboard
            }
        ]
    }
];
