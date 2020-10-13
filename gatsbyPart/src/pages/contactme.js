import React from "react";
import "../style/main.css";
import HelmetComponent from "../components/HelmetComponent";
import Header from "../templates/Header";
import MainContactMe from "../mainComponents/MainContactMe";
import Footer from "../templates/Footer";


export default function ContactMe() {
  let colorTitlesStyle={
    color: '#FFF'
  }

  return (
    <div>
      <HelmetComponent title="Contact me"/>
      <Header arrowActive="4" colorTitlesStyle={colorTitlesStyle} title1="تواصل معي" title2="سأكون سعيداً بالتواصل معك، فلا تتردد"/>
      <MainContactMe />
      <Footer />
    </div>)
}
