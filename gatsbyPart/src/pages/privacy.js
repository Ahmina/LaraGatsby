import React from "react";
import "../style/main.css";
import HelmetComponent from "../components/HelmetComponent";
import Header from "../templates/Header";
import Footer from "../templates/Footer";
import MainPrivacy from "../mainComponents/MainPrivacy";



export default function Privacy() {
  let colorTitlesStyle={
    color: '#FFF'
  }
  return (
    <div>
      <HelmetComponent title="Privacy Policy"/>
      <Header arrowActive="1" colorTitlesStyle={colorTitlesStyle} title1="سياسة الخصوصية" title2="مرحبا، هنا تجد كل مايتعلق بسياسة الخصوصية وأمان الإستخدام"/>
      <MainPrivacy/>
      <Footer />
    </div>)
}