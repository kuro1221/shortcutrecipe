export default {
    required: value => !!value || "必ず入力してください", // 入力必須の制約
    limit_min_length: value => !value || value.length >= 8 || "8文字以上で入力してください", // 文字数の制約
    limit_max_name: value => !value || value.length <= 20 || "20文字以内で入力してください", // 文字数の制約
    limit_max_length: value => !value || value.length <= 50 || "50文字以内で入力してください", // 文字数の制約
    limit_max_link: value => !value || value.length <= 150 || "150文字以内で入力してください", // 文字数の制約
    limit_max_comment: value => !value || String(value).length <= 200 || "200文字以内で入力してください", //文字数の制約
    select: value => !!value || "必ず選択してください",
    email: v => !!v.match(/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/) || '正しい形式で入力してください',
    tel: value => !!value.match(/^(0[5-9]0[0-9]{8}|0[1-9][1-9][0-c9]{7})$/) || '電話番号を正しく入力してください',
    // number: value => Number.isInteger(value) || '数値を入力してください',
    limit_max_digits: value => !value || String(value).length <= 5 || "5桁以下で入力してください", // 文字数の制約
    limit_image_size: value => !value || value.size < 8500000 || '8MB以下のファイルを選択してください',
    select_category: value => value.length > 0 || "１つ以上必ず選択してください",
}