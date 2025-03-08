
import { useForm, usePage } from '@inertiajs/react';
import {type Product} from '@/types';
import TextLink from '@/components/text-link';

export function ProductCard({ product }: { product: Product }) {

    const { data, setData, post, processing, errors } = useForm({
        productId: product.id,
        quantity: 1,
    });

    const handleAddProductToCart = (product: Product) => {
        console.log('Add product to cart', product);

        setData('productId', product.id);
        setData('quantity', 1);
        post(route('products.add-to-cart'), {
            onFinish: () => {
                setData('productId', 0);
                setData('quantity', 0);
            },
        });
    };

    const getPrice = (price: number) => {
        const total = price / 100;
        return new Intl.NumberFormat('es-ES', {
            style: 'currency',
            currency: 'MXN'
        }).format(total);
    }
    const imageProduct = product.image ? product.image : 'https://picsum.photos/170/120';

    const handleShowProduct = (product: Product) => {
        console.log('Show product', product);
        route('products.show', { product: product.id });
    }

    return (
        <section className="flex flex-col items-center gap-4 bg-[#353c59]/9 w-[210px] h-[280px] rounded-lg p-4">
            <div
                onClick={() => handleShowProduct(product)}
                className="bg-white rounded-lg mb-2  w-full cursor-pointer">
                <img
                    src={imageProduct} alt={product.name}
                    className="w-full h-[120] object-cover" />
            </div>
            <div className="bg-white rounded-b-lg p-2 w-full">
                {/*onClick={() => handleShowProduct(product)}*/}
                <TextLink
                    href={route('products.show', { product: product.id })}
                    className="text-sm text-[#353c59] font-semibold mb-0 cursor-pointer"
                    >{product.name}</TextLink>
                <p className="text-sm text-[#353c59] font-bold mb-0">
                    {getPrice(product.price)}
                </p>
            </div>
            <button
                onClick={() => handleAddProductToCart(product)}
                className="bg-[#353c59] w-[122px] h-[29px] text-sm text-white rounded-lg flex justify-center items-center cursor-pointer">
                Agregar
            </button>
        </section>
    );
}
