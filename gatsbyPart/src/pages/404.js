import React from "react";
import "../style/main.css";
import HelmetComponent from "../components/HelmetComponent";
import Header from "../templates/Header";
import Footer from "../templates/Footer";
import Main404 from "../mainComponents/Main404";



export default function NoteFound() {
  let colorTitlesStyle={
    color: '#FFF'
  }
  return (
    <div>
      <HelmetComponent title="404 - صفحة غير موجودة"/>
      <Header arrowActive="0" colorTitlesStyle={colorTitlesStyle} title1="خطأ 404" title2="خطأ في الطلب، عذرا لاتوجد هذه الصفحة"/>
      <Main404 />
      <Footer />
    </div>)
}