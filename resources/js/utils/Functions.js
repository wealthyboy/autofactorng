export const autoCredit = (amount, from_price, to_price) => {
    if (
        amount >= from_price || amount <= to_price
    ) {
        let p = (10 * amount) / 100;
        return "Your auto credit is ₦" + new Intl.NumberFormat().format(p + parseInt(amount));
    } else {
        return null
    }
}