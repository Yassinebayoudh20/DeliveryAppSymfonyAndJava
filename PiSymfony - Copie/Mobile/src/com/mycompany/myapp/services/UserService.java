/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.services;

import com.codename1.io.ConnectionRequest;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.events.ActionListener;
import com.mycompany.myapp.entities.Utilisateur;
import com.mycompany.myapp.utils.Statics;
import java.util.ArrayList;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 *
 * @author Hamza
 */
public class UserService {

    public ArrayList<Utilisateur> Utilisateurs;
    public static UserService instance = null;
    public boolean resultOK;
    private ConnectionRequest req;
    public boolean OK = false;
    

    public UserService() {
        req = new ConnectionRequest();
    }

    public static UserService getInstance() {
        if (instance == null) {
            instance = new UserService();
        }
        return instance;
    }

    public boolean AddUser(Utilisateur u) {

        String url = "http://127.0.0.1:8000/api/user?username=" + u.getUsername()
                + "&email=" + u.getEmail()
                + "&password=" + u.getPassword()
                + "&name=" + u.getNom()
                + "&lastname=" + u.getPrenom()
                + "&number=" + u.getNum_tel()
                + "&cin=" + u.getCin();

        System.out.println(url);
        req.setPost(false);
        req.setUrl(url);
        //req.addArgument("first_name", c.getNom());
        //req.addArgument("last_name", c.getPrenom());
        //req.addArgument("cardnumber", c.getCardNumber());
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;

    }

    public boolean logInuser(Utilisateur u) {
        String url = "http://127.0.0.1:8000/api/userlog?username=" + u.getUsername() + "&password=" + u.getPassword();
        System.out.println(url);
        req.setPost(false);
        req.setUrl(url);
        //req.addArgument("first_name", c.getNom());
        //req.addArgument("last_name", c.getPrenom());
        //req.addArgument("cardnumber", c.getCardNumber());
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                System.out.println(new String(req.getResponseData()));
                try {
                    JSONArray ja = new JSONArray(new String(req.getResponseData()));
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jb = ja.getJSONObject(i);
                        int id = jb.getInt("id");
                        Utilisateur.currentuser = new Utilisateur(
                                id,
                                jb.getString("username"),
                                jb.getString("email"),
                                jb.getString("password"),
                                jb.getString("nom"),
                                jb.getString("prenom"),
                                jb.getInt("numerotel"),
                                jb.getInt("cin"));
                    }
                    if(Utilisateur.currentuser != null){
                        OK = true;
                    }
                    //int id = jo.getInt("id");
                } catch (JSONException ex) {
                }
                resultOK = req.getResponseCode() == 200;
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return OK;
    }

    public boolean showuser(int id) {
        String url = "http://127.0.0.1:8000/api/usershow?id="+id;
        System.out.println(url);
        req.setPost(false);
        req.setUrl(url);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;
    }

            public Utilisateur EditUser(Utilisateur u) {
        Utilisateur user = new Utilisateur();
        user.setNom(u.getNom());
        user.setEmail(u.getNom());
        user.setCin(u.getCin());
        user.setNum_tel(u.getNum_tel());
        user.setPrenom(u.getPrenom());
        user.setUsername(u.getUsername());

        String url = "http://127.0.0.1:8000/api/editUser?idUser="
                + Utilisateur.currentuser.getId()
                + "&username=" + u.getUsername()
                + "&nom=" + u.getNom()
                + "&prenom=" + u.getPrenom()
                + "&email=" + u.getEmail()
                + "&numero=" + u.getNum_tel()
                + "&cin=" + u.getCin();
        System.out.println(url);
        req.setPost(false);
        req.setUrl(url);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return user;

    }

    public boolean ModifierPwd(String username, String password) {
        String url = "http://127.0.0.1:8000/api/changePassword?username="+ username+ "&password=" + password;
        req.setUrl(url);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;
    }

    public boolean sendMaill(String username, int code) {
        String url = Statics.BASE_URL + "codepassword/" + username + "/" + code;
        req.setUrl(url);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;
    }

}
