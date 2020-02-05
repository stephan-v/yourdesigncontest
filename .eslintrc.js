module.exports = {
  env: {
    browser: true,
    es6: true,
  },
  extends: [
    'plugin:vue/essential',
    'airbnb-base',
  ],
  globals: {
    axios: "readonly",
    Stripe: "readonly",
    Echo: "readonly",
  },
  parserOptions: {
    ecmaVersion: 2018,
    sourceType: 'module',
  },
  plugins: [
    'vue',
  ],
  rules: {
      "indent": ["error", 4],
      "max-len": ["error", { "code": 120 }],
      "no-console": 0,
      "vue/script-indent": ["error", 4, { "baseIndent": 1 }],
      "no-shadow": ["error", { "allow": ["state"] }],
      "no-param-reassign": ["error", { "props": true, "ignorePropertyModificationsFor": ["state"] }],
  },
  overrides: [
    {
      files: ['*.vue'],
      rules: {
        indent: 'off'
      }
    }
  ]
};
