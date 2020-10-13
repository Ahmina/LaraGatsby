import React from 'react';

const MainContactMe = () => {

    return (
        <main>
            <div className="main_global_container_grid main_global_container_grid_aboutme_and_contact">
                <div className="contact_container">
                    <div className="contact_container_para">
                        <p>مرحباً أيها الزائر الكريم، قم بمراسلتي على الإيميل الشخصي التالي: </p>
                        <p>AhminaMar1@gmail.com</p>
                    </div>
                    <div className="contact_container_para">
                        <p>أو عبر ملئ الخانات التالية: (جميع الخانات ضرورية)</p>
                    </div>
                    <div className="contact_container_forcenter">
                        <form>
                            <input type="input" name="name" className="input contact_input" placeholder="الإسم الكامل*"></input>
                            <input type="input" name="mail" className="input contact_input" placeholder="الإميل*"></input>
                            <textarea className="textarea contact_textarea"  placeholder="نص الرسالة"></textarea>
                            <button className="button contact_button">أرسل</button>
                        </form>
                    </div>
                </div>
            </div>
            
            

	    </main>
    );  
};

export default MainContactMe;