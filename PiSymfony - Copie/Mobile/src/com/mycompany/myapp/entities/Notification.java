/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.entities;

/**
 *
 * @author yassine bayoudh
 */
public class Notification {
    
    private String id;
    private String Content;
    private String Sender;
    private String Retriever;
    private Colis colis;
    private Utilisateur livreur;

    public String getSender() {
        return Sender;
    }

    public void setSender(String Sender) {
        this.Sender = Sender;
    }

    public String getRetriever() {
        return Retriever;
    }

    public void setRetriever(String Retriever) {
        this.Retriever = Retriever;
    }
   
    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getContent() {
        return Content;
    }

    public void setContent(String Content) {
        this.Content = Content;
    }

    public Colis getColis() {
        return colis;
    }

    public void setColis(Colis colis) {
        this.colis = colis;
    }

    public Utilisateur getLivreur() {
        return livreur;
    }

    public void setLivreur(Utilisateur livreur) {
        this.livreur = livreur;
    }
    
    
    
    
    
}
