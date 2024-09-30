const calculateDiscount = (price, discountPercentage) => {
    const discountAmount = (price * discountPercentage) / 100;
    const finalPrice = price - discountAmount;
    return finalPrice;
};

export default calculateDiscount;
