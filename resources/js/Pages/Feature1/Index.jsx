import InputError from "@/Components/InputError";
import { useForm } from "@inertiajs/react";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import PrimaryButton from "@/Components/PrimaryButton";
import Feature from "@/Components/Feature";

export default function Index({ answer, feature }) {
    const { data, setData, errors, post, processing, reset } = useForm({
        // values from below will be passed inside 'data'
        number1: "",
        number2: "",
    });

    const submit = (e) => {
        e.preventDefault();

        post(route("feature1.calculate"), {
            onSuccess() {
                reset();
            },
        });
    };

    return (
        <Feature feature={feature} answer={answer}>
            <form onSubmit={submit} className="p-8 grid grid-cols-2 gap-3">
                <div>
                    <InputLabel htmlFor="number1" value="Number 1" />
                    <TextInput
                        type="text"
                        id="number1"
                        value={data.number1}
                        onChange={(e) => setData("number1", e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.number1} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="number2" value="Number 2" />
                    <TextInput
                        type="text"
                        id="number2"
                        value={data.number2}
                        onChange={(e) => setData("number2", e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.number2} className="mt-2" />
                </div>

                <div className="flex items-center justify-end mt-4 col-span-2">
                    <PrimaryButton
                        className="ms-4"
                        disabled={processing}
                        // type="submit"
                    >
                        Calculate
                    </PrimaryButton>
                </div>
            </form>
        </Feature>
    );
}
