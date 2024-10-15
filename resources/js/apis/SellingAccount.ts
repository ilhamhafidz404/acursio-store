import axios from "axios";

type SellingAccountParams = {
    page?: number;
    minPrice?: string;
    maxPrice?: string;
    condition?: string;
};

async function getSellingAccount(params: { params: SellingAccountParams }) {
    try {
        const res = await axios.get(
            `https://genzedu.id/api/sellingAccounts/`,
            // `http://127.0.0.1:8000/api/sellingAccounts/`,
            {
                params: params || {},
            }
        );

        return res.data.result;
    } catch (error) {
        console.error("Error fetching account:", error);
        throw error;
    }
}

async function getSellingAccountById(id: number) {
    try {
        const res = await axios.get(
            `https://genzedu.id/api/sellingAccounts/${id}`
        );
        // const res = await axios.get(
        //     `http://127.0.0.1:8000/api/sellingAccounts/${id}`
        // );

        return res.data.result;
    } catch (error) {
        console.error("Error fetching account:", error);
        throw error;
    }
}

export { getSellingAccount, getSellingAccountById };
