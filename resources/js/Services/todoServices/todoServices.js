import axios from "axios";

async function getAll({ token, user_id }) {
    if (!token) {
        return {
            Erro: "Token vazio"
        };
    }

    const config = {
        Accept: "application/json",
        Authorization: "Bearer " + token
    };

    const response = await axios
        .get(`/api/todo/getAll/${user_id}`, config)
        .then(response => response.data);

    return response;
}

async function addTodo({ todoName, todoUser, token }) {
    if (!todoName || !todoUser || !token) {
        return {
            Erro: "Parametros necessarios vazios"
        };
    }

    const config = {
        Accept: "application/json",
        Authorization: "Bearer " + token
    };

    const data = {
        name: todoName
    };

    const response = await axios
        .post(`/api/todo/add/${todoUser}`, data, config)
        .then(response => response.data);

    return response;
}

async function doneOrUndoneTodo({ todoId, todoValue, token }) {
    if (!todoId || todoValue == undefined || !token) {
        return {
            Erro: "Parametros necessarios vazios"
        };
    }

    const config = {
        Accept: "application/json",
        Authorization: "Bearer " + token
    };

    const data = {
        value: todoValue
    };

    const response = await axios
        .put(`/api/todo/done/${todoId}`, data, config)
        .then(response => response.data);

    return response;
}

export { getAll, addTodo, doneOrUndoneTodo };
