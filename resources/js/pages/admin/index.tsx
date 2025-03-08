import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';
import { useForm, usePage } from '@inertiajs/react';
import { Product } from '@/types';

export default function index({ products }: { products: Product[] }) {

    const {  delete : destroy, } = useForm({} )
    const getPrice = (price: number) => {
        const total = price / 100;
        return new Intl.NumberFormat('es-ES', {
            style: 'currency',
            currency: 'MXN'
        }).format(total);
    }

    const handleDeleteProduct = (product: Product) => {
        console.log('Delete product', product);
        destroy(route('products.destroy', { product: product.id }));
    }

    return (
        <AppLayout>
            <Head title="Products" />
            <div className="flex flex-col gap-4 rounded-xl p-4">
                <h1 className="text-2xl font-semibold">Productos</h1>
                <div className="relative overflow-x-auto">
                    <table
                        className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" className="px-6 py-3">
                                Nombre del producto
                            </th>
                            <th scope="col" className="px-6 py-3">
                                Precio
                            </th>
                            <th scope="col" className="px-6 py-3">
                                Stock
                            </th>
                            <th scope="col" className="px-6 py-3">
                                Categoria
                            </th>
                            <th scope="col" className="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        {products.map((product) => (
                            <tr
                                className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200"
                                key={product.id}>
                                <th scope="row" className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{product.name}</th>
                                <td className="px-6 py-4">
                                    $ {getPrice(product.price)}
                                </td>
                                <td className="px-6 py-4">{product.stock}</td>
                                <td className="px-6 py-4">{product.category.name}</td>
                                <td className="px-6 py-4">
                                    <div className="flex justify-evenly">
                                        <button
                                            className="bg-[#353c59] w-[60px] h-[22px] text-[12px] text-white rounded-lg flex justify-center items-center cursor-pointer">
                                            Agregar
                                        </button>
                                        <button
                                            onClick={() => handleDeleteProduct(product)}
                                            className="bg-red-700 w-[60px] h-[22px] text-[12px] text-white rounded-lg flex justify-center items-center cursor-pointer"
                                        >
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </AppLayout>
);
}
