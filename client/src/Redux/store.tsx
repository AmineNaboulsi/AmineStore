import { configureStore } from "@reduxjs/toolkit";
import Order from './Slices/Order'


export const store = configureStore({
    reducer: {
        Orderinfo : Order
    }
});

export type RootState = ReturnType<typeof store.getState>
export type AppDispatch = typeof store.dispatch


export default store