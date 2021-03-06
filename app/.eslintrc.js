module.exports = {
  root: true,
  env: {
    browser: true,
    node: true
  },
  parserOptions: {
    "ecmaVersion": 6 ,
    "ecmaFeatures": {
      "experimentalObjectRestSpread": true,
      "experimentalDecorators": true,
      "jsx": true
    },
    "sourceType": 'module',
    "parser": 'babel-eslint'
  },
  extends: [
    "eslint:recommended",
    "plugin:vue/recommended",
    "plugin:prettier/recommended"
  ],
  plugins: [
    'vue'
  ],
  rules: {
    "semi": [2, "never"],
    "no-console": "off",
    "vue/max-attributes-per-line": "off",
    "prettier/prettier": ["error", { "semi": false }],
    "no-unused-vars": "off"
  }
}
