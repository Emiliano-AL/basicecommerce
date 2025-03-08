import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';
import { ProductCard } from '@/components/products/product-card';
import { Product } from '@/types';

export default function index({ products }: { products: Product[] }) {
    return (
        <AppLayout>
            <Head title="Products" />
            <div className="flex flex-col gap-4 rounded-xl p-4">
                <h1 className="text-2xl font-semibold">Products</h1>
                <div className="grid gap-4 md:grid-cols-3 lg:grid-cols-4">
                    {products.map((product) => (
                        <ProductCard
                            key={product.id}
                            product={product} />
                    ))}
                </div>
            </div>
        </AppLayout>
    );
}
