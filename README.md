
# Human Resource Information System PT. Indo Global Impex Web Application

Human Resource Information System PT. Indo Global Impex or I mostly say "HRIS IGI" is web application for managing employees inside the company. There is several function or features inside application like :

- Employees data management
- Leave application management
- Payroll management
- Absence / Presence management
- And recruitment management




## Screenshots

![Login](https://raw.githubusercontent.com/BryaanF/hris-igi/refs/heads/master/screenshots/Login.jpg)

![Data Karyawan](https://raw.githubusercontent.com/BryaanF/hris-igi/refs/heads/master/screenshots/Data%20Karyawan.jpg)

![Absensi Harian](https://raw.githubusercontent.com/BryaanF/hris-igi/refs/heads/master/screenshots/Absensi.jpg)



## Tech Stack

**Frontend :** HTML, CSS (Bootstrap), Javascript (Vanilla and Jquery)

**Backend :** PHP (Laravel)

**Package Manager :** Composer, Node JS

**Database:** Mysql 


## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`MAIL_MAILER=smtp`

`MAIL_HOST=smtp.gmail.com`

`MAIL_PORT=587`

`MAIL_USERNAME=yourgmail@gmail.com`

`MAIL_PASSWORD="asdg ffgh zxcz rtyt"`

note : you can get this mail password by go to your google security settign and find password for third party apps to access (tldr : google app password) 

`MAIL_ENCRYPTION=tls`

`MAIL_FROM_ADDRESS=sameasmailusername@gmail.com`

`MAIL_FROM_NAME="${APP_NAME}"`

`MASTER_PASSWORD='your-master-password-can-be-any!'`

the rest you can set database as your db setting, I use mysql for databse you can import from hris_igi.sql file to reference for database

## Run Locally

To deploy this project you can clone this repo first and then set up the .env as above, then you can start downloading resources from NPM pacakge and composer package

```bash
  npm install or npm i
```

```bash
  composer install or composer i
```

after you install the pacakge you can run the project locally by running on 2 different terminal with this 2 syntax

```bash
  php artisan serve
```

```bash
  npm run dev
```
## FAQ

#### What this site about ?

This site is about my project for Human Resource Information Systems or you can reference as enterprise resource planning (ERP) for human resources module that build on top of laravel. This project aim to manage everything (it can be) to manage employee.

#### Why I build this project?

I build this project to complete my final project to graduate from college as a student from Information Systems major in Telkom University Surabaya.


## License

MIT License

Copyright (c) [2024] [Brilliant Fikri]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
[MIT](https://choosealicense.com/licenses/mit/)


## Authors

- [@Liant](https://www.github.com/BryaanF)

