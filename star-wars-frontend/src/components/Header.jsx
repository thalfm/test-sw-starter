import React from "react";
import "./Header.css";
import SWStarter from './SWStarter';

export default function Header({ title = "SW Starter", onLogoClick = () => {} }) {
  return (
    <header className="app-header">
        <div className="app-title">{title}</div>
    </header>
  );
}
