import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';
import { Product } from '@/types';

export default function detail({ product } : { product: Product }) {
    const imageProduct = product.image ? product.image : 'https://picsum.photos/270/220';
    const getPrice = (price: number) => {
        const total = price / 100;
        return new Intl.NumberFormat('es-ES', {
            style: 'currency',
            currency: 'MXN'
        }).format(total);
    }
    return (
        <AppLayout>
            <Head title={product.name} />
            <div className="flex flex-col gap-4 rounded-xl p-4">
                <div className="bg-[#353c59] w-full h-[70px] rounded-lg mb-4 flex justify-center items-center">
                    <h3 className="text-white font-bold text-2xl">Detalles del producto</h3>
                </div>
                <article className="mx-auto w-[800px] flex gap-4 justify-evenly">
                    <img
                        src={imageProduct} alt={product.name}
                        className="w-[270px] h-[220] object-cover" />
                    <div className="flex flex-col">
                        <h3 className="text-xl font-semibold text-[#353c59]">
                            {product.name}
                        </h3>
                        <p className="text-[#353c59] font-bold">
                            {getPrice(product.price)}
                        </p>
                    </div>
                </article>
                <div className="mx-auto w-[800px] flex flex-col items-center gap-4">
                    <p className="text-[#353c59] font-bold">
                        {product.description}
                    </p>
                    <button
                        className="bg-[#353c59] w-[322px] h-[39px] text-xl text-white rounded-lg flex justify-center items-center cursor-pointer">
                        Agregar
                    </button>
                </div>
            </div>
        </AppLayout>
    );
}
