import axios from "axios";

async function doRegister({ name, email, password }) {
    if (!name || !email || !password) {
        return {
            Erro: "Campos requeridos vazios"
        };
    }

    if (password.length < 8) {
        return {
            Erro: "Senha deve ter 8 ou mais caracteres"
        };
    }

    const response = await axios
        .post("api/user/register", {
            name,
            email,
            password
        })
        .then(response => response.data);

    return response;
}

async function doLogin({ email, password }) {
    if (!email || !password) {
        return {
            Erro: "Campos requeridos vazios"
        };
    }

    const response = await axios
        .post("/api/user/login", {
            email,
            password
        })
        .then(response => response.data);

    return response;
}

export { doRegister, doLogin };
