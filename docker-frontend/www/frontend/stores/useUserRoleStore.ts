import { defineStore } from "pinia";
import { role as Role } from "#imports";

type User = {
    id: number;
    role: Role;
    roleName: string;
    type: number;
};

export const useUserRoleStore = defineStore("role", () => {
    const user = ref<User>({
        id: -1,
        role: Role.Unknown,
        roleName: "Unknown",
        type: 0,
    });

    return { user };
});
