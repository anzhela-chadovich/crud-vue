import http from "../http-common";

class Http {
    get_all_products() {
        return http.get("/get_products");
    }

    delete_one_product(id) {
        return http.get(`/delete_product/${id}`);
    }

    find(search) {
        return http.get(`/search_products?search=${search}`);
    }

    create_product(data) {
        return http.post(`/add_product`, data);
    }

    get_editable_product(data) {
        return http.get(`/get_edit_product/${data}`);
    }

    save_editable_product(id,data) {
        return http.post(`/update_product/${id}`, data)
    }
}

export default new Http();
