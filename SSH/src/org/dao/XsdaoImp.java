package org.dao;

import org.dao.imp.Xsdao;
import org.model.XsbEntity;
import org.springframework.orm.hibernate4.support.HibernateDaoSupport;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;


import java.util.List;

/**
 * Created by wujiacheng on 16/6/5.
 */
public class XsdaoImp extends HibernateDaoSupport implements Xsdao {
    @Override
    public void save(XsbEntity xs) {
        getHibernateTemplate().save(xs);
    }

    @Override
    public void delete(String xh) {
        getHibernateTemplate().delete(find(xh));
    }

    @Override
    public void update(XsbEntity xs) {
        getHibernateTemplate().update(xs);
    }

    @Override
    public XsbEntity find(String xh) {
        List list=getHibernateTemplate().find("from XsbEntity where xh=?",xh);
        if(list.size()>0)
            return (XsbEntity) list.get(0);
        else
            return null;
    }

    @Override
    public List findAll(int pageNow, int pageSize) {
        try{
            Session session=getHibernateTemplate().getSessionFactory().openSession();
            Transaction ts=session.beginTransaction();
            Query query=session.createQuery("from XsbEntity order by xh");

            int firstResult=(pageNow-1)*pageSize;
            query.setFirstResult(firstResult);
            query.setMaxResults(pageSize);
            List list=query.list();
            ts.commit();
            session.close();
            //session=null;
            return list;
        }catch(Exception e){
            e.printStackTrace();
            return null;
        }

    }

    @Override
    public int findXsSize() {
        return getHibernateTemplate().find("from XsbEntity ").size();
    }
}
