/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.ui.Button;
import com.codename1.ui.Dialog;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextField;
import com.codename1.ui.layouts.FlowLayout;
import com.mycompany.myapp.entities.Utilisateur;
import com.mycompany.myapp.services.UserService;

/**
 * GUI builder created Form
 *
 * @author ASUS
 */
public class GuiLogin extends Form {

    public GuiLogin(Form f) {
        setTitle("Log In");
        setLayout(new FlowLayout(CENTER));
        Label usernameTxt = new Label("Username : ");
        usernameTxt.getStyle().setFgColor(0x000000);
        Label passwordTxt = new Label("Password : ");
        passwordTxt.getStyle().setFgColor(0x000000);
        TextField firstNametxtF = new TextField();
        TextField passwordtxtF = new TextField("", "", 20, TextField.PASSWORD);

        Button submit = new Button("Sign In");
        Button forgetPassword = new Button("Forget Password");
        Button register = new Button("Register");

        forgetPassword.addActionListener((m) -> {
            new GuiForgetPassword(firstNametxtF.getText(), f).show();

        });
        register.addActionListener((re) -> {
            new GuiRegister(f).show();
        });

        submit.addActionListener((evt) -> {
            Utilisateur user = new Utilisateur();
            user.setUsername(firstNametxtF.getText());
            user.setPassword(passwordtxtF.getText());
            if (UserService.getInstance().logInuser(user)) {
                   Dialog.show("Welcome", "Your are welcome here", "OK", null);
                new GUIHomePage(f).show();
            } else {
                Dialog.show("Incorrect", "something is wrong", "Try Again", null);

            }

        });
        addAll(usernameTxt, firstNametxtF, passwordTxt, passwordtxtF, submit, register, forgetPassword);

    }

}
