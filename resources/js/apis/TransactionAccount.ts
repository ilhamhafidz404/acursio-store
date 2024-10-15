import axios from "axios";

async function getTransactionAccount() {
    try {
        // const res = await axios.get(
        //     `https://genzedu.id/api/transactionAccounts/${invoice}`
        // );
        const res = await axios.get(
            `http://127.0.0.1:8000/api/transactionAccounts/`
        );

        return res.data.result.data;
    } catch (error) {
        console.error("Error fetching account:", error);
        throw error;
    }
}

async function showTransactionAccount(invoice: string) {
    try {
        // const res = await axios.get(
        //     `https://genzedu.id/api/transactionAccounts/${invoice}`
        // );
        const res = await axios.get(
            `http://127.0.0.1:8000/api/transactionAccounts/${invoice}`
        );

        return res.data.result;
    } catch (error) {
        console.error("Error fetching account:", error);
        throw error;
    }
}

export { showTransactionAccount, getTransactionAccount };
