package org.tool;

import java.util.Map;
import org.model.DlbEntity;

import com.opensymphony.xwork2.Action;
import com.opensymphony.xwork2.ActionInvocation;
import com.opensymphony.xwork2.interceptor.AbstractInterceptor;

/**
 * Created by wujiacheng on 16/6/7.
 */
public class MyFilter extends AbstractInterceptor {
    @Override
    public String intercept(ActionInvocation actionInvocation) throws Exception {
        Map session=actionInvocation.getInvocationContext().getSession();
        DlbEntity user=(DlbEntity) session.get("user");
        if(user==null){
            return Action.LOGIN;
        }
        return actionInvocation.invoke();

    }
}
