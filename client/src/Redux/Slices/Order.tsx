import { createSlice , PayloadAction } from "@reduxjs/toolkit";

type ProductType  =  {
    id_p: number,
    name: string,
    price: number,
    subtotal: number,
    description: string,
    quantité: number,
    img: string,
    categoriename: string 
}

type PanierState = {
    panier: ProductType[];
};

const getPanierFromLocalStorage = (): ProductType[] => {
    const panier = localStorage.getItem('panier');
    return panier ? JSON.parse(panier) : [];
};
const initialState: PanierState = {
    panier: getPanierFromLocalStorage(),
};


const SlicePanier = createSlice({
    name: "panier",
    initialState,
    reducers: {
        AddToPanier: (state, action: PayloadAction<ProductType>) => {
            const existingProduct = state.panier.find(
                (product) => product.id_p === action.payload.id_p
              );
        
              if (existingProduct) {
                existingProduct.quantité += action.payload.quantité || 1;
                existingProduct.subtotal =  0;
                
            } else {
                  localStorage.setItem('panier' ,JSON.stringify(state.panier))
                  state.panier.push({ ...action.payload, quantité: action.payload.quantité || 1 , subtotal : 0 });
              }
        },
        MoreQuaniter : (state , action:PayloadAction<{id_p:number}>) =>{
            state.panier.forEach(
                (product:ProductType)=> {
                    if(product.id_p === action.payload.id_p){
                        product.quantité++ ;
                        product.subtotal = Number(product.price)* Number(product.quantité);
                        localStorage.setItem('panier' , JSON.stringify(state.panier));
                    }
                    
                }
            );
        },
        LessQaniter : (state , action:PayloadAction<{id_p:number}>) =>{
            state.panier.forEach(
                (product:ProductType)=> {
                    if(product.id_p === action.payload.id_p){
                        if(product?.quantité>0){ 
                            product.quantité-- ;
                            product.subtotal = (Number(product.price )* Number(product.quantité));
                            localStorage.setItem('panier' ,JSON.stringify(state.panier))
                        }
                    }
                }
            );
        }
    },
});

export const { AddToPanier , MoreQuaniter , LessQaniter} = SlicePanier.actions;
export default SlicePanier.reducer;