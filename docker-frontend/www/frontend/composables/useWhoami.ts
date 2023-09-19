import { role as Role } from "#imports";

export default function () {
    return useState("whoami", () => ({
        user: "Unknown",
    }));
}
