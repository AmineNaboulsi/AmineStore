import { createSlice , PayloadAction } from "@reduxjs/toolkit";

type ProductType  =  {
    id_p: number,
    name: string,
    prix: number,
    description: string,
    quantité: number,
    img: string,
    categoriename: string 
}

type PanierState = {
    panier: ProductType[];
};
const initialState: PanierState = {
    panier: [
        {
            id_p: 5,
            name: "string",
            prix: 156,
            description: "loremcds vdso dldss",
            quantité: 9,
            img: "dcdcdds oj odvdojvn ds",
            categoriename: "MAC" 
        }
    ]
};

const SlicePanier = createSlice({
    name: "panier",
    initialState,
    reducers: {
        AddToPanier: (state, action: PayloadAction<ProductType>) => {
            state.panier.push(action.payload);
        },
    },
});

export const { AddToPanier } = SlicePanier.actions;
export default SlicePanier.reducer;