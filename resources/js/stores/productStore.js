import {defineStore} from "pinia";


export const useProductStore = defineStore('productStoreId',
    {
        state: () => ({
           products: [],
            id: 0,
        }),
        getters: {
            allProducts(state) {
                return state.products
            }
        },
        actions:{
            add_product_store(name,description,image,category,quantity,price) {
                this.products.push({
                    id:this.id++,
                    name,
                    description,
                    image,
                    category,
                    quantity,
                    price,
                })
            },
            delete_product_store(product_id) {
                this.products = this.products.filter((object) => {
                    return object.id !== product_id;
                })
            },
        },
        persist:true,
    })
