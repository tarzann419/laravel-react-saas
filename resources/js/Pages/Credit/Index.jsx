import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import PackagesPricingCards from "@/Components/PackagesPricingCards";

export default function Index({
    auth,
    packages,
    features,
    success,
    error,
}) {
    const availableCredits = auth.user.available_credits;

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="text-xl font-semibold text-gray-900 dark:text-gray-200 leading-tight">
                    Your Credits
                </h2>
            }
        >
            <Head title="Your Credits"/>
                <div className="py-12">
                    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        {success && (
                            <div className="rounded-lg bg-emerald-500 text-gray-100 mb-4 p-3">
                                {success}
                            </div>
                        )}

                        {error && (
                            <div className="rounded-lg bg-red-500 text-gray-100 mb-4 p-3">
                                {error}
                            </div>
                        )}

                        <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg relative">
                            <div className="flex flex-col gap-3 items-center p-4">
                                <img
                                    src="/coin.jpeg"
                                    alt="coin"
                                    className="w-[100px]"
                                />
                                <h3 className="text-white text-2xl">
                                    You have {availableCredits} Credits
                                </h3>
                            </div>
                        </div>
                        <PackagesPricingCards
                            features={features.data}
                            packages={packages.data}
                        />
                    </div>
                </div>
        </AuthenticatedLayout>
    );
}
